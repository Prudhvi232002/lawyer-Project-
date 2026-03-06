<?php

namespace App\Http\Conversations;

use App\Models\LawFirm;
use App\Models\LawFirmCategory;
use App\Models\Lawyer;
use App\Models\LawyerCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Exception;
use Illuminate\Support\Facades\Log;

class ServicesConversations extends Conversation
{
    /**
     * Start the conversation
     *
     * @return mixed
     */

    protected $name = '';
    protected $email = '';
    protected $service = '';
    protected $list_of_keywords = [];

    public function __construct()
    {
        // Load keywords from the external file
        $this->list_of_keywords = require __DIR__ . '/ListOfKeywords.php';
    }

    public function run()
    {
        $this->ask('Hi there! What is your Name?', function (Answer $answer) {
            $this->name = $answer->getText();
            if (empty($this->name)) {
                $this->say('Name cannot be empty.');
                return $this->repeat();
            }
            $this->say('Hi! Nice to meet you, ' . $this->name);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('What is your Email?', function (Answer $answer) {
            $this->email = $answer->getText();
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->say('Please enter a valid email address.');
                return $this->repeat();
            }
            $this->askForOptions();
        });
    }

    protected function askForOptions()
    {

        $questions = Question::create('Please Select your needy Option?')
            ->fallback('Unable to ask question')->addButtons([
                Button::create('I need a Lawyer')->value('lawyer'),
                Button::create('I need a Lawfirm')->value('lawfirm'),
                Button::create('I need a Service')->value('service'),
            ]);
        $this->ask($questions, function (Answer $answer) {
            if (!$answer->isInteractiveMessageReply()) {
                $this->say('Please select an option.');
                return $this->repeat();
            }
            $selected_option = $answer->getValue();
            $this->say('You selected : ' . $selected_option);
            if ($selected_option == 'lawyer') {
                $this->askLawyerCategories();
            } elseif ($selected_option == 'lawfirm') {
                $this->askLawfirmCategories();
            } else {
                $this->askServiceCategories();
            }
        });
    }

    protected function askLawyerCategories()
    {
        try {
            $lawyer_categories = LawyerCategory::active()->get();
            if ($lawyer_categories->isEmpty()) {
                $this->say('No lawyer categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of lawyer do you want?')
                ->fallback('Unable to ask question');

            foreach ($lawyer_categories as $lawyer_category) {
                $questions->addButton(Button::create($lawyer_category->name)->value($lawyer_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a lawyer category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->lawyerSuggestions($selectedCategoryId, 'category');
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }


    protected function askLawfirmCategories()
    {
        try {
            $lawfirm_categories = LawFirmCategory::active()->get();
            if ($lawfirm_categories->isEmpty()) {
                $this->say('No lawfirm categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of lawfirm do you want?')
                ->fallback('Unable to ask question');

            foreach ($lawfirm_categories as $lawfirm_category) {
                $questions->addButton(Button::create($lawfirm_category->name)->value($lawfirm_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a lawfirm category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->lawfirmSuggestions($selectedCategoryId);

            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }





    protected function askServiceCategories()
    {
        try {
            $service_categories = ServiceCategory::all();
            if ($service_categories->isEmpty()) {
                $this->say('No service categories available at the moment.');
                return;
            }

            $questions = Question::create('Which type of service do you want?')
                ->fallback('Unable to ask question');

            foreach ($service_categories as $service_category) {
                $questions->addButton(Button::create($service_category->name)->value($service_category->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a service category.');
                    return $this->repeat();
                }

                $selectedCategoryId = $answer->getValue();
                $this->say('You selected category ID: ' . $selectedCategoryId);
                $this->askService($selectedCategoryId);
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving service categories. Please try again later.');
            Log::error('Error fetching service categories: ' . $e->getMessage());
        }
    }

    protected function askService($selectedCategoryId)
    {
        try {
            $services = Service::where('service_category_id', $selectedCategoryId)->get();
            if ($services->isEmpty()) {
                $this->say('No services available for this category.');
                return;
            }

            $questions = Question::create('List of Services');

            foreach ($services as $service) {
                $questions->addButton(Button::create($service->name)->value($service->id));
            }

            $this->ask($questions, function (Answer $answer) {
                if (!$answer->isInteractiveMessageReply()) {
                    $this->say('Please select a service.');
                    return $this->repeat();
                }

                $service_id = $answer->getValue();
                $this->say('You selected Service ID: ' . $service_id);
                $this->lawyerSuggestions($service_id, 'service');
            });
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving services. Please try again later.');
            Log::error('Error fetching services: ' . $e->getMessage());
        }
    }

    protected function lawyerSuggestions($id, $type)
    {
        try {
            $lawyers = Lawyer::limit(5);
            if ($type == 'category') {
                $lawyers->whereHas('lawyer_categories', function ($query) use ($id) {
                    $query->where('lawyer_category_id', $id);
                });
            } else {
                $lawyers = $lawyers->has('lawyer_services');
            }
            $lawyers = $lawyers->get();

            if ($lawyers->isEmpty()) {
                $this->say('No lawyers found for this service.');
                return;
            }


            $listItems = '';
            $this->say('list of Lawyers: ');
            foreach ($lawyers as $lawyer) {
                $listItems .= '<li>Name: <a href="' . url('/lawyer/profile/' . $lawyer->user_name) . '" target="_blank">' . $lawyer->name . '</a></li>';
            }
            $messageContent = '<ul>' . $listItems . '</ul>';
            $message = OutgoingMessage::create($messageContent);
            $this->say($message);
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving lawyers. Please try again later.');
            Log::error('Error fetching lawyers: ' . $e->getMessage());
        }
    }

    protected function lawfirmSuggestions($id)
    {
        try {
            $lawfirms = LawFirm::limit(5);
            $lawfirms->whereHas('law_firm_categories', function ($query) use ($id) {
                $query->where('law_firm_id', $id);
            });

            $lawfirms = $lawfirms->get();

            if ($lawfirms->isEmpty()) {
                $this->say('No lawfirms found for this service.');
                return;
            }

            $listItems = '';
            $this->say('list of lawforms: ');
            foreach ($lawfirms as $lawfirm) {
                $listItems .= '<li>Name: <a href="' . url('/law_firm/profile/' . $lawfirm->user_name) . '" target="_blank">' . $lawfirm->name . '</a></li>';
            }
            $messageContent = '<ul>' . $listItems . '</ul>';
            $message = OutgoingMessage::create($messageContent);
            $this->say($message);
        } catch (Exception $e) {
            $this->say('An error occurred while retrieving lawfirms. Please try again later.');
            Log::error('Error fetching lawfirms: ' . $e->getMessage());
        }
    }
}
