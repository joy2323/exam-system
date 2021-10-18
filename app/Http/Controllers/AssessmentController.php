<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assessment;
use App\Http\Requests\Api\CreateAssessmentRequest;
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

        // $allAssess = $this->repository->paginate($request);
        $allAssess = $this->repository->get($request);
        return response()->json(['allAssess' => $allAssess]);
    }


    public function create(createAssessmentRequest $request)
    {
        // For Creating New Assessment data to database table


        try {
            $createAssessment = $this->repository->store($request);
            return response()->json(['createAssessment' => $createAssessment], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }


    /**
     * Display the specified assessment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSingleAssessment($id)
    {
        //to show a single assessment using 'id'


        try {
            $getSingleAssess = $this->repository->show($id);
            return response()->json(['getSingleAssessment' => $getSingleAssess], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
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

        try {
            $updateAssessment = $this->repository->update($id, $request);
            return response()->json(['updateAssessment' => $updateAssessment], 200);
        } catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()], 500);
        }


    }

    /**
     * Remove the specified Assessment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //to remove an assessment

        try {
            $this->repository->delete($id);
            return response()->json(true,'Assessment was deleted successfully',[],'',200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
