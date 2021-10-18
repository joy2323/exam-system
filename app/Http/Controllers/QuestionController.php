<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;

use App\Http\Requests\Api\CreateQuestionRequest;
use App\Repositories\QuestionRepository;
use Exception;

class QuestionController extends Controller
{
    protected $repository;


    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //list all the questions

        $allQues = $this->repository->get($request);
        return response()->json(['allQuestions' => $allQues]);

    }


    public function create(CreateQuestionRequest $request)
    {
        //for creating a new question.

        try {
            $createQuestion = $this->repository->store($request);
            return response()->json(['createQuestion' => $createQuestion], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }


    }


    /**
     *  List all questions by assessment_id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //List all questions by assessment_id.


        $getQuestByAssess = Assessment::whereId($id)->with('question')->first();

        // dd($getQuestByAssess);

        if($getQuestByAssess){
            return response()->json([
                "status"=>201,
                "result"=>$getQuestByAssess
            ]);
        }else{
            return response()->json([
                "status"=>304,
                "result"=>"Not Found"
            ]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
