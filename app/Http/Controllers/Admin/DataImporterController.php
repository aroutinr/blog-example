<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DataImporterRequest;
use App\Jobs\DataImporterJob;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class DataImporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = new Post();
    	$post_columns = $posts->getFillable();
    	$queued_jobs = Queue::size();

        return view('admin.data-importer.index', compact('post_columns', 'queued_jobs'))->with('title', 'Data Importer');
    }

    public function import(DataImporterRequest $request)
    {
		$json = json_decode(file_get_contents($request->url), true); // DECODE DEL JSON DESDE LA WEB

		if (!$json) 
		{
		    return back()->with('status', 'The URL is not a valid API endpoint.');
		}

		if (count(array_filter(array_keys($json), 'is_string')) > 0) 
		{
			foreach (array_keys($json) as $array_key) 
			{
				if (is_array($array_key)) 
				{
					return back()->with('status', 'Error when trying to retrieve data from API endpoint');
				}

				$key = $array_key;
			}

			$json = $json[$key];
		}

		DataImporterJob::dispatch($json);

		return back()->with('status', 'Data imported successfully. The data was send to the queue worker and is queued to be imported.');
    }

    public function runQueueWorker()
    {
    	$queued_jobs = Queue::size();
    	for ($i = 1; $i <= $queued_jobs; $i++) 
    	{
		    \Artisan::call('queue:work --once');
		}

        return back()->with('status', 'Queue worker executed.');
    }
}
