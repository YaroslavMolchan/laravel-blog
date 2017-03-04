<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TagsCreateRequest;
use App\Http\Requests\TagsUpdateRequest;
use App\Repositories\TagRepository;


class TagsController extends Controller
{

    /**
     * @var TagRepository
     */
    protected $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $tags = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tags,
            ]);
        }

        return view('tags.index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TagsCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tag = $this->repository->create($request->all());

            $response = [
                'message' => 'Tags created.',
                'data'    => $tag->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tag,
            ]);
        }

        return view('tags.show', compact('tag'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tag = $this->repository->find($id);

        return view('tags.edit', compact('tag'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  TagsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(TagsUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tag = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Tags updated.',
                'data'    => $tag->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Tags deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tags deleted.');
    }
}
