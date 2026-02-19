<?php

namespace App\Http\Controllers\Customers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\AddLawyerReviewRequest;
use App\Http\Requests\Customers\AddLawFirmReviewRequest;

class ReviewsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth');
    //   $this->middleware('customer');
  }


  public function addLawyerReview(AddLawyerReviewRequest $request)
  {
      $user = auth()->user();
      $customer = $user->customer;
      if($customer){
          $customer->lawyer_reviews()->create($request->all());
      }
      request()->session()->flash('alert', [
          'type' => 'success',
          'message' => 'Review Added Successfully',
      ]);
      return redirect()->back()->withResponseData([
          'message' => 'Review Added Successfully',
          'type' => 'success'
      ]);
  }
  public function addLawFirmReview(AddLawFirmReviewRequest $request)
  {
      $user = auth()->user();
      $customer = $user->customer;
      if($customer){
          $customer->law_firm_reviews()->create($request->all());
      }
      request()->session()->flash('alert', [
          'type' => 'success',
          'message' => 'Review Added Successfully',
      ]);
      return redirect()->back()->withResponseData([
          'message' => 'Review Added Successfully',
          'type' => 'success'
      ]);
  }
}
