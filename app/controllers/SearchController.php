<?php

class SearchController extends BaseController {
    public function index()
    {
        return View::make("search");
    }

    public function results()
    {
        $query = Input::get("search");
        $startDate = Input::get("startDate");
        $endDate = Input::get("endDate");
        $sorting = Input::get("sorting");

        if($query == "" && $startDate == "" && $endDate == "")
            return Redirect::route("search")->withErrors(array("Must include a search term or date range."));

        $statement = "select * ";
        if($query != "" && $sorting == "relevance")
            $statement .= ", match(p.first_name,p.last_name)
                             against ('{$query}' in boolean mode) as patient_score,
                             match(r.description)
                             against ('{$query}' in boolean mode) as description_score,
                             match(r.diagnosis)
                             against ('{$query}' in boolean mode) as diagnosis_score ";

        $statement .= "from oralism.radiology_record r, oralism.persons p
                       where r.patient_id = p.person_id";

        if($query != "")
            $statement .= " and (match(p.first_name,p.last_name)
                                 against ('{$query}' in boolean mode)
                                 or
                                 match(r.description,r.diagnosis)
                                 against ('{$query}' in boolean mode))";

        if($startDate != "")
            $statement .= " and r.test_date >= '{$startDate}'";

        if($endDate != "")
            $statement .= " and r.test_date <= '{$endDate}'";

        if($query && $sorting == "relevance")
            $statement .= " order by (6*patient_score + 3*diagnosis_score + description_score) desc";
        else if($sorting == "recent_first")
            $statement .= " order by test_date desc";
        else if($sorting == "recent_last")
            $statement .= " order by test_date asc";

        return DB::select($statement);
    }
}
