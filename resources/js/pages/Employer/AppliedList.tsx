import { Link } from '@inertiajs/react';
import Form from '../../CustomComponents/Form';
import Navbar from '../../CustomComponents/Navbar';


export default function AppliedList({employees}) {
    const headers = ['Email', 'Select'];
    return (
        <div>
            <Navbar fields={[{name: 'Create Task', href: '/employer/task/create'}, {name: 'Completed Tasks', href: '#'}, {name: 'Posted Tasks', href: '/employer/task/list'}, {name: 'In-Progress Tasks', href: '#'}]}  account={{profile: '#', delete: '#'}}/>
            <div className="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table className="table">
                <thead>
                    <tr>
                        <th></th>
                        {headers.map((header, index) => (
                            <th key={index}>{header}</th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {employees.map((employee: any, index: number) => (
                        <tr key={index}>
                            <th>{index + 2}</th>
                            <td>{employee.employee_email}</td>
                            <td>
                                <Link className="btn btn-outline btn-accent" href={`/employer/employeeSelect/${employee.employee_id}/${employee.task_id}`}>Select</Link>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
        </div>
    );
}