<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseCreateRequestChild;
use App\Http\Requests\EnterpriseEditRequest;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class BackendEnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $enterprises = Enterprise::all();
        /*$query = $request->get('query');
        echo $query;
        $query = $request->query('query');
        echo $query;*/
        //$response = ['op' => 'create', 'r' => 1, 'id' => 1];
        //$request->session()->flash('op', 'create');
        //$request->session()->flash('id', '1');
        return view('backend.enterprise.index', ['enterprises' => $enterprises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.enterprise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnterpriseCreateRequestChild $request)
    {
        /*$name1 = $request->input('name');
        $name2 = $request->name;
        $name3 = $request->input('name', 'Kekas');
        $all = $request->all();
        $input = $request->input();*/

        //1
        //$enterprise = new Enterprise($request->all());
        //$result = $enterprise->save();
        //$result - número de registros guardados, $enterprise->id
        //2
        //$enterprise = Enterprise::create($request->all());
        //$enterprise->id

        //$enterprise = new Enterprise($request->all());
        $enterprise = new Enterprise($request->validated());
        //$enterprise->name = strtoupper($enterprise->name);
        //$enterprise->name = mb_strtoupper($enterprise->name);
        //sql
        try {
            $result = $enterprise->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        if($enterprise->id > 0) {
            $response = ['op' => 'create', 'r' => $result, 'id' => $enterprise->id];
            return redirect('backend/enterprise')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
            //return back()->withInput()->withErrors(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show(Enterprise $enterprise)
    {
        //$enterprise = Enterprise::find($id);

        $extensions = ['gif', 'jpeg', 'jpg', 'png'];
        $logo = 'logo.png';
        $string = '';
        foreach($extensions as $extension) {
            $string = $string . $extension . ' - ';
            if(file_exists('logos/' . $enterprise->id . '.' . $extension)) {
                $logo = $enterprise->id . '.' . $extension;
                break;
            }
        }

        /*$path = public_path('logo'); // /var/wwww/html/laraveles/thirdApplication/public/logo/
        $files = \File::files($path); //1, 2, 3.jpg, 6, logo.png
        $logo = 'logo.png';
        foreach($files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME); //1, 2, 3, 6, logo
            if($fileName == $enterprise->id) {
                $logo = $file->getFileName(); //1, 2, 3.jpg, 6, logo.png
                break;
            }
        }*/
        return view('backend.enterprise.show', ['enterprise' => $enterprise, 'logo' => $logo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Enterprise $enterprise)
    {
        return view('backend.enterprise.edit', ['enterprise' => $enterprise]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function update(EnterpriseEditRequest $request, Enterprise $enterprise)
    {
        //1º Request (reglas simples)
        //2º reglas programar
        //3º reglas SQL -> diferenciar tipos
        $public = $this->uploadPublicFile($request, $enterprise->id);
        $private = $this->uploadPrivateFile($request, $enterprise->id);
        try {
            $result = $enterprise->update($request->validated());
        } catch (\Exception $e) {
            $result = 0;
        }
        /*if(true) {
            return back()->withInput()->withErrors(['name' => 'Una empresa no se puede llamar así.']);
        }*/
        /*$enterprise->fill($request->all());
        $result = $enterprise->save();*/
        if($result) {
            $response = ['op'         => 'update',
                            'r'       => $result,
                            'id'      => $enterprise->id,
                            'public'  => $public,
                            'private' => $private];
            return redirect('backend/enterprise')->with($response);
        } else {
            return back()->withInput()->withErrors(['name' => 'El nombre de la empresa ya existe.']);
        }
    }

    private function deleteFiles($id) {
        $extensions = ['gif', 'jpeg', 'jpg', 'png'];
        $deleted = 0;
        $errors = 0;
        foreach($extensions as $extension) {
            if(file_exists('logo/' . $id . '.' . $extension) &&
                !unlink('logo/' . $id . '.' . $extension)) {
                    $errors++;
            }
        }
        return $errors == 0;
    }

    private function uploadFile(Request $request, $id, string $fileName, string $target, $deleteFiles = false) {
        $result = false;
        $deleted = true;
        if($request->hasFile($fileName) && $request->file($fileName)->isValid()) {
            if($deleteFiles) {
                $deleted = $this->deleteFiles($id);
            }
            $file = $request->file($fileName);
            $ext = \File::extension($file->getClientOriginalName());
            $name = $id . '.' . $ext;
            $result = $file->move($target, $name);
        }
        return $result && $deleted;
    }

    private function uploadPublicFile(Request $request, $id) {
        return $this->uploadFile($request, $id, 'logo', 'logos/', true);
    }

    private function uploadPrivateFile(Request $request, $id) {
        return $this->uploadFile($request, $id, 'privada', '/var/www/privada/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enterprise $enterprise)
    {
        $id = $enterprise->id;
        try {
            $result = $enterprise->delete();
        } catch(\Exception $e) {
            $result = 0;
        }
        //$result = Enterprise::destroy($enterprise->id);
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/enterprise')->with($response);
    }
}
