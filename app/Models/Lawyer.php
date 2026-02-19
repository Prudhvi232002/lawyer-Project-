<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\Lawyer\AddressesRelations;
use Spatie\Translatable\HasTranslations;

class Lawyer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Billable , AddressesRelations, HasTranslations;
    public $translatable = ['description'];

    protected $fillable = [
        'law_firm_id','user_id','pricing_plan_id', 'country_id', 'state_id', 'city_id', 'state_id', 'first_name','last_name','experience','speciality','is_premium',

        'prefix','suffix','home_phone','cell_phone','job_title','company','website','email',
        'billing_address_line_1','billing_address_line_2','billing_country_id', 'billing_state_id', 'billing_city_id','billing_zip_code',
        'shipping_address_line_1','shipping_address_line_2','shipping_country_id', 'shipping_state_id', 'shipping_city_id','shipping_zip_code',
        'work_address_line_1','work_address_line_2','work_country_id', 'work_state_id', 'work_city_id','work_zip_code',
        'description', 'longitude','latitude','address_line_1','address_line_2', 'is_active', 'is_approved', 'approved_at', 'is_featured', 'icon',
        'image', 'cover_image','user_name','zip_code','is_certified','is_verified','is_co_creation','is_energy_exchange','is_special','is_spotlight' , 'profile_completion_percentage','is_online'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function scopeWithAll($query)
    {
        return $query->distance(request()->get('latitude'),request()->get('longitude'))->with('law_firm')->with('lawyer_categories')->with('appointment_schedules', function($q
        )
        {
            $q->with('appointment_type');
        })->with('user')->with('lawyer_certifications')->with('lawyer_settings')->with('languages')->with('tags')->with('lawyer_reviews', function ($q) {
            $q->active();
            $q->has('customer');
            $q->withAll();
        })->withAddresses();
    }
    public function scopewithAddresses($query)
    {
        return $query
        ->with('country')
        ->with('state')
        ->with('city')
        ->with('billing_country')
        ->with('billing_state')
        ->with('billing_city')
        ->with('work_country')
        ->with('work_state')
        ->with('work_city')
        ->with('shipping_country')
        ->with('shipping_state')
        ->with('shipping_city');

    }
    public function scopeDistance($query, $latitude, $longitude, $distance = null, $unit = "km")
    {

        if ($latitude && $longitude) {
            $constant = $unit == "km" ? 6371 : 3959;
            $haversine = "(
                $constant * acos(
                    cos(radians(" .$latitude. "))
                    * cos(radians(`latitude`))
                    * cos(radians(`longitude`) - radians(" .$longitude. "))
                    + sin(radians(" .$latitude. ")) * sin(radians(`latitude`))
                )
            )";
            if($distance){
                return $query->whereNotNULL('longitude')->WhereNotNull('latitude')->select('*',DB::raw("$haversine AS distance"))
                ->having("distance", "<=", $distance);
            }else{
                // dd($haversine);
                return $query->select('*',DB::raw("$haversine AS distance"));
            }
        }else{
            return $query;
        }

    }
    public function scopeWithChildrens($query)
    {
        return $query->with('lawyer_broadcasts', function ($q) {
            $q->active();
            $q->hasModulePermissions();
        })
            ->with('lawyer_podcasts', function ($q) {
                $q->active();
                $q->hasModulePermissions();
            })
            ->with('lawyer_services', function ($q) {
                $q->active();
                $q->hasModulePermissions();
            })->with('lawyer_events', function ($q) {
                $q->active();
                $q->hasModulePermissions();
                $q->upcoming();
            })->with('lawyer_posts', function ($q) {
                $q->active();
                $q->hasModulePermissions();
            })->with('lawyer_archives', function ($q) {
                $q->active();
                $q->hasModulePermissions();
            })->with('pricing_plan', function ($q) {
                $q->with('lawyer_modules');
            });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePremium($query)
    {
        return $query->where('is_premium', 1);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pricing_plan()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id')->withTrashed();
    }

    public function lawyer_categories()
    {
        return $this->belongsToMany(LawyerCategory::class, 'lawyer_category');
    }

    public function lawyer_posts()
    {
        return $this->hasMany(Post::class);
    }
    public function lawyer_archives()
    {
        return $this->hasMany(Archive::class);
    }
    public function lawyer_broadcasts()
    {
        return $this->hasMany(Broadcast::class);
    }
    public function lawyer_podcasts()
    {
        return $this->hasMany(Podcast::class);
    }
    public function lawyer_services()
    {
        return $this->hasMany(Service::class);
    }
    public function lawyer_events()
    {
        return $this->hasMany(Event::class);
    }
    public function lawyer_settings()
    {
        return $this->hasMany(LawyerSetting::class);
    }
    public function lawyer_reviews()
    {
        return $this->hasMany(LawyerReview::class);
    }
    public function appointments()
    {
        return $this->hasMany(BookAppointment::class);
    }
    public function services()
    {
        return $this->hasMany(BookedService::class);
    }
    public function lawyer_certifications()
    {
        return $this->hasMany(Certification::class);
    }
    public function languages()
    {
        return $this->belongsToMany(AllLanguage::class, 'lawyer_language');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lawyer_tag');
    }
    public function scopeTopRated($query)
    {
        return $query->whereHas('lawyer_reviews', function ($q) {
            $q->where('rating', '>=', 4);
            $q->orderBy('rating', 'desc');
        });
    }
    public function appointment_schedules()
    {
        return $this->hasMany(AppointmentSchedule::class,'lawyer_id','id');
    }
    public function scopeShowLocation($query)
    {
        return $query->where('is_hide_location', 0)->orWhereNull('is_hide_location');
    }
    public function lawyer_experiences()
    {
        return $this->hasMany(LawyerExperience::class);
    }
    public function lawyer_educations()
    {
        return $this->hasMany(LawyerEducation::class);
    }
    public function law_firm()
    {
        return $this->belongsTo(LawFirm::class);
    }
}
