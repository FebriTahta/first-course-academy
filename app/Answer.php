<?php
use App\Pertanyaan;
use App\Answer;
use App\Result;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
        'pertanyaan_id','answer','is_correct'
	];
	
    public function storeAnswer($data,$pertanyaans){
    	foreach($data['options'] as $key=>$option){
    		$is_correct =false;
    		if($key==$data['correct_answer']){
    			$is_correct=true;
    		}

    		$answer = Answer::create([
    			'pertanyaan_id'=> $pertanyaans->id,
    			'answer'=>$option,
                'is_correct'=>$is_correct,                
    		]);

    	}
	}

	public function deleteAnswer($id){
		Answer::where('pertanyaan_id', $id)->delete();
	}

	public function updateAnswer($data, $pertanyaan){
		$this->deleteAnswer($pertanyaan->id);
		$this->storeAnswer($data, $pertanyaan); 
	}

	public function pertanyaan()
	{
		return $this->belongsTo(Pertanyaan::class);
	}

	public function result()
    {
        return $this->hasMany(Result::class);
    }
}
