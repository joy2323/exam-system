<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all the question
        $allQues = Question::all();
            return response()->json($allQues);

    }


    public function create(Request $request)
    {
        //for creating a new question.
        $createQuestion = Question::create([
            'question' =>$request->question,
            'question_category' =>$request->question_category,
            'assessment_id'=>$request->assessment_id,
            // 'options'   => ['Option 1', 'Option 2', 'Option 3', 'Option 4']
            'options' =>$request->options,
        ]);
        if ($createQuestion->save() );
            return response()->json([
                'status'=> '200',
                'message'=>'Successful',
                'result' => $createQuestion,
            ]);

            return response()->json([
                'status'=> '500',
                'message'=>'Action denied'
            ]);


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

        // $assessment = Assessment::whereId($id)->first();
        // var_dump($assessment);
        // $getSingleAssesQues = Question::where('assessment_id', $assessment->id)->get('question');

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
