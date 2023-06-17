<?php 

namespace App\Repository;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository
{
    public function store($data)
    {
        $fileName = '';
        if(isset($data['image'])){
            $fileName = $this->saveImage($data);
        }
        Employee::create($this->getDataArray($data, $fileName));
    }

    public function update($data, $employee)
    {
        if(isset($data['image'])){
            // unlink($data['first_name'] . $data['phone'] . '.' . $data['image']->extension());
            $fileName = $this->saveImage($data);
        }else{
            $fileName = $employee->image;
        }

        $employee->update($this->getDataArray($data, $fileName));
    }

    public function destroy($employee)
    {
        $employee->delete();
    }

    private function getDataArray($data, $fileName)
    {
        return [
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'password'      => Hash::make($data['password']),
            'salary'        => $data['salary'],
            'department_id' => $data['department_id'] == 0 ?  null : $data['department_id'],
            'manager_id'    => $data['manager_id'] == 0 ?  null : $data['manager_id'],
            'role'          => $data['role'] == 0 ? "employee" : $data['role'],
            'image'         => $fileName,
        ];
    }

    private function saveImage($data)
    {
        $fileName = $data['phone'] . '.' . $data['image']->extension();
        $data['image']->move(public_path('uploads'), $fileName);
        return $fileName;
    }
}
?>