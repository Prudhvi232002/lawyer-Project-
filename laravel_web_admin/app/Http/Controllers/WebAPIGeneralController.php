<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ArchiveCategoriesResource;
use App\Http\Resources\Web\BlogCategoriesResource;
use App\Http\Resources\Web\LawFirmCategoriesResource;
use App\Http\Resources\Web\LawFirmsResource;
use App\Http\Resources\Web\ArchivesResource;
use App\Http\Resources\Web\BroadcastsResource;
use App\Http\Resources\Web\LawFirmReviewsResource;
use App\Http\Resources\Web\LawyerCategoriesResource;
use App\Http\Resources\Web\EventsResource;
use App\Http\Resources\Web\FAQSResource;
use App\Http\Resources\Web\LawyerMainCategoriesResource;
use App\Http\Resources\Web\PostsResource;
use App\Http\Resources\Web\PodcastsResource;
use App\Http\Resources\Web\LawyerReviewsResource;
use App\Http\Resources\Web\LawyersResource;
use App\Http\Resources\Web\ServiceCategoriesResource;
use App\Http\Resources\Web\ServicesResource;
use App\Http\Resources\Web\TagsResource;
use App\Http\Resources\Web\TestimonialsResource;
use App\Models\ArchiveCategory;
use App\Models\BlogCategory;
use App\Models\LawFirm;
use App\Models\LawFirmCategory;
use App\Models\City;
use App\Models\Country;
use App\Models\Lawyer;
use App\Models\Archive;
use App\Models\Broadcast;
use App\Models\LawFirmReview;
use App\Models\State;
use App\Models\LawyerCategory;
use App\Models\Event;
use App\Models\FAQ;
use App\Models\LawyerMainCategory;
use App\Models\Post;
use App\Models\Podcast;
use App\Models\LawyerReview;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Tag;
use App\Models\Testimonial;
use Illuminate\Support\Arr;
use App\Http\Resources\Web\CommunityPostsResource;

class WebAPIGeneralController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchLawyerReviews($req = null,$user_name)
    {
        if ($req != null) {
            $reviews =  LawyerReview::withAll()->active()->whereHas('lawyer',function($q) use($user_name){
                $q->where('user_name',$user_name);
                $q->active();
            });
            if ($req->column && $req->column != null && $req->search != null) {
                $reviews = $reviews->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $reviews = $reviews->whereLike(['comment','rating'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $reviews = $reviews->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $reviews = $reviews->OrderBy('id', 'desc');
            }
            $reviews = $reviews->paginate($req->perPage ?? 10);
            $reviews = LawyerReviewsResource::collection($reviews)->response()->getData(true);
            return $reviews;
        }
        $reviews = LawyerReview::withAll()->active()->whereHas('lawyer',function($q) use($user_name){
            $q->where('user_name',$user_name);
            $q->active();
        })->orderBy('id', 'desc')->paginate(10);
        $reviews = LawyerReviewsResource::collection($reviews)->response()->getData(true);
        return $reviews;
    }

        /********* Getter For Pagination, Searching And Sorting  ***********/
        public static function searchLawFirmReviews($req = null,$user_name)
        {
            if ($req != null) {
                $reviews =  LawFirmReview::withAll()->active()->whereHas('law_firm',function($q) use($user_name){
                    $q->where('user_name',$user_name);
                    $q->active();
                });
                if ($req->column && $req->column != null && $req->search != null) {
                    $reviews = $reviews->whereLike($req->column, $req->search);
                } else if ($req->search && $req->search != null) {
                    $reviews = $reviews->whereLike(['comment','rating'], $req->search);
                }
                if ($req->sort_field != null && $req->sort_type != null) {
                    $reviews = $reviews->OrderBy($req->sort_field, $req->sort_type);
                } else {
                    $reviews = $reviews->OrderBy('id', 'desc');
                }
                $reviews = $reviews->paginate($req->perPage ?? 10);
                $reviews = LawFirmReviewsResource::collection($reviews)->response()->getData(true);
                return $reviews;
            }

            $reviews = LawFirmReview::withAll()->active()->whereHas('law_firm',function($q) use($user_name){
                $q->where('user_name',$user_name);
                $q->active();
            })->orderBy('id', 'desc')->paginate(10);
            $reviews = LawFirmReviewsResource::collection($reviews)->response()->getData(true);
            return $reviews;
        }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchLawyers($req = null)
    {
        if ($req != null) {
            $lawyers =  Lawyer::withAll()->has('user')->whereNotNull('user_name')->active()->approved();
            // if($req->lawyer_category){
            //     $lawyers = $lawyers->whereHas('lawyer_categories',function($q) use($req){
            //         $q->where('lawyer_categories.slug',$req->lawyer_category);
            //     });
            // }
            // else if($req->lawyer_main_category){
            //     $lawyer_main_category = LawyerMainCategory::where('slug',$req->lawyer_main_category)->first();
            //     if($lawyer_main_category){
            //         $lawyers = $lawyers->whereHas('lawyer_categories',function($q) use($req,$lawyer_main_category){
            //             $q->where('lawyer_categories.parent_category_id',$lawyer_main_category->id);
            //         });
            //     }
            // }
            if($req->main_category && $req->main_category != 'all' && $req->lawyer_category == 'all'){
                $lawyers = $lawyers->whereHas('lawyer_categories',function($q) use($req){
                    $q->whereHas('main_category',function($y) use($req){
                        $y->where('lawyer_main_categories.slug',$req->main_category);
                    });
                });
            }
            if($req->lawyer_category && $req->lawyer_category != 'all'){
                if(is_array($req->lawyer_category)){
                     $slugs = Arr::flatten($req->lawyer_category);
                        $lawyers = $lawyers->whereHas('lawyer_categories',function($q) use($req , $slugs){
                            $q->whereIn('lawyer_categories.slug',$slugs);
                        });
                }else{
                    $lawyers = $lawyers->whereHas('lawyer_categories',function($q) use($req){
                        $q->where('lawyer_categories.slug',$req->lawyer_category);
                    });
                }
            }
            if($req->language){
                $lawyers = $lawyers->whereHas('languages',function($q) use($req){
                    $q->where('all_languages.iso_code',$req->language);
                });
            }
            if($req->is_featured){
                $lawyers = $lawyers->featured();
            }
            if($req->country){
                $lawyers = $lawyers->where('country_id',$req->country);
            }
            if($req->zip_code){
                $lawyers = $lawyers->where('zip_code',$req->zip_code);
            }
            if($req->is_top_rated){
                $lawyers = $lawyers->topRated();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyers = $lawyers->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $lawyers = $lawyers->whereLike(['first_name','last_name', 'description'], $req->search);
            }
            // if ($req->sort_field != null && $req->sort_type != null) {
            //     $lawyers = $lawyers->OrderBy($req->sort_field, $req->sort_type);
            // }
            if($req->latitude && $req->longitude){
                $lawyers = $lawyers->distance($req->latitude,$req->longitude,$req->distance);
                $lawyers = $lawyers->OrderBy('distance', 'asc');
        }
            else {
                $lawyers = $lawyers->OrderBy('id', 'desc');
            }
            $lawyers = $lawyers->paginate($req->perPage ?? 10);
            $lawyers = LawyersResource::collection($lawyers)->response()->getData(true);
            return $lawyers;
        }
        $lawyers = Lawyer::withAll()->orderBy('id', 'desc')->paginate(10);
        $lawyers = LawyersResource::collection($lawyers)->response()->getData(true);
        return $lawyers;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchLawFirms($req = null)
    {
        if ($req != null) {
            $law_firms =  LawFirm::withAll()->has('user')->whereNotNull('user_name')->active()->approved();
            // dd($req->all());
            if($req->law_firm_category){
                $law_firms = $law_firms->whereHas('law_firm_categories',function($q) use($req){
                    $q->where('law_firm_categories.slug',$req->law_firm_category);
                });
            }
            if($req->country){
                $law_firms = $law_firms->where('country_id',$req->country);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firms = $law_firms->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $law_firms = $law_firms->whereLike(['first_name','last_name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firms = $law_firms->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firms = $law_firms->OrderBy('id', 'desc');
            }
            $law_firms = $law_firms->paginate($req->perPage ?? 10);
            $law_firms = LawFirmsResource::collection($law_firms)->response()->getData(true);
            return $law_firms;
        }
        $law_firms = LawFirm::withAll()->orderBy('id', 'desc')->paginate(10);
            $law_firms = LawFirmsResource::collection($law_firms)->response()->getData(true);
        return $law_firms;
    }

        /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchEvents($req = null)
    {
        if ($req != null) {
            $events =  Event::withAll()->active()->approved()->upcoming()->hasModulePermissions();
            if($req->month){
                $months = ['jan' => 1,'feb' => 2,'mar' => 3,'apr' => 4,'may' => 5,'jun' => 6,'jul' => 7,
                            'aug' => 8,'sep' => 9,'oct' => 10,'nov' => 11,'dec' => 12];
                if(isset($months[$req->month])){
                    $events = $events->whereMonth('starts_at', $months[$req->month]);
                }
            }
            if($req->address){
                $events = $events->whereLike('address', $req->address);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $events = $events->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $events = $events->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $events = $events->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $events = $events->OrderBy('id', 'desc');
            }
            $events = $events->paginate($req->perPage ?? 10);
            $events = EventsResource::collection($events)->response()->getData(true);
            return $events;
        }
        $events = Event::withAll()->hasModulePermissions()->active()->upcoming()->orderBy('id', 'desc')->paginate(10);
        $events = EventsResource::collection($events)->response()->getData(true);
        return $events;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchPosts($req = null)
    {
        if ($req != null) {
            $posts =  Post::withAll()->active()->hasModulePermissions();
            if($req->tag){
                $posts = $posts->whereHas('tags',function($q) use($req){
                    $q->where('slug',$req->tag);
                });
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $posts = $posts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $posts = $posts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $posts = $posts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $posts = $posts->OrderBy('id', 'desc');
            }
            $posts = $posts->paginate($req->perPage ?? 10);
            $posts = PostsResource::collection($posts)->response()->getData(true);
            return $posts;
        }
        $posts = Post::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $posts = PostsResource::collection($posts)->response()->getData(true);
        return $posts;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchArchives($req = null)
    {
        if ($req != null) {
            $archives =  Archive::withAll()->active()->hasModulePermissions();
            if($req->tag){
                $archives = $archives->whereHas('tags',function($q) use($req){
                    $q->where('slug',$req->tag);
                });
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $archives = $archives->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $archives = $archives->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $archives = $archives->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $archives = $archives->OrderBy('id', 'desc');
            }
            $archives = $archives->paginate($req->perPage ?? 10);
            $archives = ArchivesResource::collection($archives)->response()->getData(true);
            return $archives;
        }
        $archives = Archive::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $archives = ArchivesResource::collection($archives)->response()->getData(true);
        return $archives;
    }

    /********* Getter For Pagination, Searching And Sorting  ***********/
    public static function searchBroadcasts($req = null)
    {
        if ($req != null) {
            $broadcasts =  Broadcast::withAll()->active()->hasModulePermissions();
            if($req->tag){
                $broadcasts = $broadcasts->whereHas('tags',function($q) use($req){
                    $q->where('slug',$req->tag);
                });
            }
            if($req->type){
                $broadcasts = $broadcasts->whereLike('file_type', $req->type);
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $broadcasts = $broadcasts->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {
                $broadcasts = $broadcasts->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $broadcasts = $broadcasts->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $broadcasts = $broadcasts->OrderBy('id', 'desc');
            }
            $broadcasts = $broadcasts->paginate($req->perPage ?? 10);
            $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
            return $broadcasts;
        }
        $broadcasts = Broadcast::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
        $broadcasts = BroadcastsResource::collection($broadcasts)->response()->getData(true);
        return $broadcasts;
    }

       /********* Getter For Pagination, Searching And Sorting  ***********/
       public static function searchPodcasts($req = null)
       {
           if ($req != null) {
               $podcasts =  Podcast::withAll()->active()->hasModulePermissions();
               if($req->tag){
                    $podcasts = $podcasts->whereHas('tags',function($q) use($req){
                        $q->where('slug',$req->tag);
                    });
                }
                if($req->type){
                    $podcasts = $podcasts->whereLike('file_type', $req->type);
                }
               if ($req->column && $req->column != null && $req->search != null) {
                   $podcasts = $podcasts->whereLike($req->column, $req->search);
               } else if ($req->search && $req->search != null) {
                   $podcasts = $podcasts->whereLike(['name', 'description'], $req->search);
               }
               if ($req->sort_field != null && $req->sort_type != null) {
                   $podcasts = $podcasts->OrderBy($req->sort_field, $req->sort_type);
               } else {
                   $podcasts = $podcasts->OrderBy('id', 'desc');
               }
               $podcasts = $podcasts->paginate($req->perPage ?? 10);
               $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
               return $podcasts;
           }
           $podcasts = Podcast::withAll()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
           $podcasts = PodcastsResource::collection($podcasts)->response()->getData(true);
           return $podcasts;
       }

             /********* Getter For Pagination, Searching And Sorting  ***********/
             public static function searchServices($req = null)
             {
                 if ($req != null) {
                     $services =  Service::approved()->withAll()->active()->hasModulePermissions();
                     if($req->tag){
                          $services = $services->whereHas('tags',function($q) use($req){
                              $q->where('slug',$req->tag);
                          });
                      }
                      if($req->service_category){
                        $services = $services->whereHas('service_category',function($q) use($req){
                            $q->where('slug',$req->service_category);
                        });
                    }
                     if ($req->column && $req->column != null && $req->search != null) {
                         $services = $services->whereLike($req->column, $req->search);
                     } else if ($req->search && $req->search != null) {
                         $services = $services->whereLike(['name', 'description'], $req->search);
                     }
                     if ($req->sort_field != null && $req->sort_type != null) {
                         $services = $services->OrderBy($req->sort_field, $req->sort_type);
                     } else {
                         $services = $services->OrderBy('id', 'desc');
                     }
                     $services = $services->paginate($req->perPage ?? 10);
                     $services = ServicesResource::collection($services)->response()->getData(true);
                     return $services;
                 }
                 $services = Service::withAll()->approved()->hasModulePermissions()->orderBy('id', 'desc')->paginate(10);
                 $services = ServicesResource::collection($services)->response()->getData(true);
                 return $services;
             }


    public static function getCountries($request){
        $countries = Country::active()->get();
        return $countries;
    }
    public static function getStates($request){
        $states = State::active()->where('country_id',$request->country_id)->get();
        return $states;
    }

    public static function getTestimonials($request){
        $testimonials = Testimonial::active()->get();
        $testimonials = TestimonialsResource::collection($testimonials);
        return $testimonials;
    }

    public static function getLawFirmCategories($request){
        $law_firm_categories = LawFirmCategory::active()->get();
        $law_firm_categories = LawFirmCategoriesResource::collection($law_firm_categories);
        return $law_firm_categories;
    }

    public static function getTags($request){
        $tags = Tag::active()->get();
        $tags = TagsResource::collection($tags);
        return $tags;
    }

    public static function getServiceCategories($request){
        $service_categories = ServiceCategory::active();
        if($request->has_services){
        $service_categories = $service_categories->whereHas('services',function($q){
            $q->active();
        });
        }
        $service_categories = $service_categories->get();
        $service_categories = ServiceCategoriesResource::collection($service_categories);
        return $service_categories;
    }

    public static function getBlogCategories($request){
        $blog_categories = BlogCategory::active()->get();
        $blog_categories = BlogCategoriesResource::collection($blog_categories);
        return $blog_categories;
    }

    public static function getFaqs($request){
        $faqs = FAQ::active()->get();
        $faqs = FAQSResource::collection($faqs);
        return $faqs;
    }

    public static function getArchiveCategories($request){
        $archive_categories = ArchiveCategory::active()->get();
        $archive_categories = ArchiveCategoriesResource::collection($archive_categories);
        return $archive_categories;
    }

    public static function getLawyerCategories($request){
        $lawyer_categories = LawyerCategory::active()->get();
        $lawyer_categories = LawyerCategoriesResource::collection($lawyer_categories);
        return $lawyer_categories;
    }
    public static function getFeaturedLawyerCategories($request){
        // $featured_lawyer_categories = LawyerMainCategory::active()->featured()->whereHas('categories',function($q){
        //     $q->active();
        // })->withAll()->withChildrens()->get();
        $featured_lawyer_categories = LawyerMainCategory::active()->featured()->get();
        $featured_lawyer_categories = LawyerMainCategoriesResource::collection($featured_lawyer_categories);
        return $featured_lawyer_categories;

    }

    public static function getCities($request){
        $cities = City::active()->where('country_id',$request->country_id)->where('state_id',$request->state_id)->get();
        return $cities;
    }
    public static function getFeaturedLawyers($request){
        $featured_lawyers = Lawyer::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured();
        if($request->latitude && $request->longitude){
            $featured_lawyers = $featured_lawyers->distance($request->latitude,$request->longitude);
            $featured_lawyers = $featured_lawyers->OrderBy('distance', 'asc');
        }
        $featured_lawyers = $featured_lawyers->get();

        $featured_lawyers = LawyersResource::collection($featured_lawyers);
        return $featured_lawyers;
    }

    public static function getTopRatedLawyers($request){
        $top_rated_lawyers = Lawyer::withAll($request)->has('user')->whereNotNull('user_name')->active()->approved()->topRated()->get();
        $top_rated_lawyers = LawyersResource::collection($top_rated_lawyers);
        return $top_rated_lawyers;
    }

    public static function getPremiumLawyers($request){
        $premium_lawyers = Lawyer::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->premium();
        $premium_lawyers = $premium_lawyers->get();
        $premium_lawyers = LawyersResource::collection($premium_lawyers);
        return $premium_lawyers;
    }
    public static function getFeaturedTags($request){
        $featured_tags = Tag::withAll()->active()->get();
        $featured_tags = TagsResource::collection($featured_tags);
        return $featured_tags;
    }

    public static function getFeaturedEvents($request){
        $featured_events = Event::withAll()->active()->upcoming()->featured()->get();
        $featured_events = EventsResource::collection($featured_events);
        return $featured_events;
    }

    public static function getSpotlightLawyers($request){
        $spotlight_lawyers = Lawyer::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->get();
        $spotlight_lawyers = LawyersResource::collection($spotlight_lawyers);
        return $spotlight_lawyers;
    }

    public static function getFeaturedLawFirms($request){
        $featured_law_firms = LawFirm::withAll()->has('user')->whereNotNull('user_name')->active()->approved()->featured()->get();
        $featured_law_firms->each(function ($law_firm) {
            $law_firm->setRelation(
                'law_firm_lawyers',
                $law_firm->law_firm_lawyers->take(4)
            );
        });
        $featured_law_firms = LawFirmsResource::collection($featured_law_firms);
        return $featured_law_firms;
    }

    public static function getTrendingCommunityPosts($request)
    {
        $community_posts = Post::withAll()->withChildren()->active()->latest()->get();
        $community_posts = CommunityPostsResource::collection($community_posts);
        return $community_posts;
    }
}
