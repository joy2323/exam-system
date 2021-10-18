<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assessment;
use App\Http\Requests\Api\CreateQuestionRequest;
use App\Http\Requests\Api\UpdateQuestionRequest;
use App\Repositories\AssessmentRepository;
use Exception;

class AssessmentController extends Controller
{
    protected $repository;

    public function __construct(AssessmentRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // To show all the assessments

        // $allAssess = Assessment::all();
        // return response()->json($allAssess);


        // $allAssess = $this->repository->paginate($request);
        $allAssess = $this->repository->get($request);
        return response()->json(['allAssess' => $allAssess]);
    }


    public function create(createQuestionRequest $request)
    {
        // For Creating New Assessment

        $createAssessment = Assessment::create([
            'name' =>$request->name,
            'description' =>$request->description,
        ]);
        if ($createAssessment->save()) {
            return response()->json([
                'status'=> '201',
                'message' => 'Assessment added successfully !!'
            ]);
        } else {
            return response()->json([
                'status'=> '300',
                'message'=>'Not successful'

            ]);
        }
    }


    /**
     * Display the specified assessment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSingleAssessment($assessment)
    {
        //to show a single assessment using 'id'

        $getSingleAssess = Assessment::whereId($assessment)->first();
        if(!$getSingleAssess){
            return response()->json([
             'status'=> 404,
             'message' => 'This Assessment is not found in the database'
            ]);
        }
        return response()->json([
            'status'=> 200,
             'message' => 'Successful',
             'result' => [
                 'Id'=>$getSingleAssess->id,
                 'name'=>$getSingleAssess->name,
                 'description'=>$getSingleAssess->description,
             ]
        ]);
    }


    /**
     * Update the specified assessment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Update a specified assessment

        $updateAssessment=Assessment::whereId($id)->first();
        $updateAssessment->name=$request->name;
        $updateAssessment->description=$request->description;
        if ($updateAssessment->save()){
            return response()->json([
                'status'=> 200,
                'message'=> 'Assessment successfully Updated !!'
                ]);
        }else{
            return response()->json([
                'status'=> '500',
                'message'=> 'Assessment has not been Updated'
            ]);
        }


    }

    /**
     * Remove the specified Assessment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assessment)
    {
        //to remove an assessment
        $assessment = Assessment::whereId($assessment)->first();
        if ($assessment->delete()){
            return response()->json([
                'success'=>true,
                'message'=>'Assessment was successfully deleted'],200);
            }else{
                    return response()->json([
                   'success'=>false,
                   'message'=>'Assessment details not deleted',
               ], 500);
            }

    }
}
