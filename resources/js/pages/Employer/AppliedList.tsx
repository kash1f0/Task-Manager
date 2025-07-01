import { Link } from '@inertiajs/react';
import Navbar from '../../CustomComponents/Navbar';

export default function AppliedList({ employees }) {
    const headers = ['Email', 'Select'];
    return (
        <div>
            <Navbar
                fields={[
                    { name: 'Create Task', href: '/employer/task/create' },
                    { name: 'Completed Tasks', href: '/employer/completedTasks' },
                    { name: 'Posted Tasks', href: '/employer/task/list' },
                    { name: 'In-Progress Tasks', href: '/employer/currentTasks' },
                    { name: 'Edit Profile', href: '/employer/profile' },
                    { name: 'Logout', href: '/employer/logout' },
                ]}
                
            />
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
                                <td>{employee.email}</td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employer/employeeSelect/${employee.id}/${employee.task_id}`}>
                                        Select
                                    </Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
