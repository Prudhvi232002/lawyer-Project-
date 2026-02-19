<?php

namespace App\Http\Controllers\API\Customers;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Customers\AddLawyerReviewRequest;
use App\Http\Requests\API\Customers\AddLawFirmReviewRequest;

class APIReviewsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
      $this->middleware('auth:api');
    //   $this->middleware('customer');
  }


  public function addLawyerReview(AddLawyerReviewRequest $request)
  {
      $user = auth()->user();
      $customer = $user->customer;
      if($customer){
          $customer->lawyer_reviews()->create($request->all());
      }
      $response = generateResponse(null,true,"Review Added Successfully",null,'collection');
      return response()->json($response);
  }
  public function addLawFirmReview(AddLawFirmReviewRequest $request)
  {
      $user = auth()->user();
      $customer = $user->customer;
      if($customer){
          $customer->law_firm_reviews()->create($request->all());
      }
      $response = generateResponse(null,true,"Review Added Successfully",null,'collection');
      return response()->json($response);
  }
}
