<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;
use App\Http\Resources\Skill as SkillResource;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skill_info = Skill::where('id', 1)->first();
        return new SkillResource($skill_info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSkills()
    {
        $data = request()->validate([
                'skill_header' => 'required',
                'language_header' => 'required',
                'first_skill' => 'required',
                'first_skill_percent' => 'required',
                'second_skill' => 'required',
                'second_skill_percent' => 'required',
                'third_skill' => 'required',
                'third_skill_percent' => 'required',
                'first_language' => 'required',
                'first_language_percent' => 'required',
                'second_language' => 'required',
                'second_language_percent' => 'required',
                'third_language' => 'required',
                'third_language_percent' => 'required',
        ]);

        Skill::where('id', 1)->update([
            'skill_header' => $data['skill_header'],
            'language_header' => $data['language_header'],
            'first_skill' => $data['first_skill'],
            'first_skill_percent' => $data['first_skill_percent'],
            'second_skill' => $data['second_skill'],
            'second_skill_percent' => $data['second_skill_percent'],
            'third_skill' => $data['third_skill'],
            'third_skill_percent' => $data['third_skill_percent'],
            'first_language' => $data['first_language'],
            'first_language_percent' => $data['first_language_percent'],
            'second_language' => $data['second_language'],
            'second_language_percent' => $data['second_language_percent'],
            'third_language' => $data['third_language'],
            'third_language_percent' => $data['third_language_percent'],
        ]);

        $updatedSkill = Skill::where('id', 1)->first();
        return new SkillResource($updatedSkill);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
