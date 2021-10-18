<?php
namespace App\Repositories;

use App\Models\Assessment;
use App\Models\Question;
use App\Repositories\AppRepository;
use Illuminate\Http\Request;

class QuestionRepository extends AppRepository
{
    protected $model;

    public function __construct(Assessment $model)
    {
        $this->model = $model;
    }

    /**
     * set payload data for question table.
     *
     * @param Request $request [description]
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];
    }
}
