import { Link } from '@inertiajs/react';
import Navbar from '../../CustomComponents/Navbar';

export default function Profile({ employee }) {
    const headers = ['Name', 'Email', 'About', 'edit', 'delete'];
    return (
        <div>
            <Navbar
                fields={[
                    { name: 'Find Task', href: '/employee/findTasks' },
                    { name: 'Completed Task', href: '/employee/completedTasks' },
                    { name: 'Applied Task', href: '/employee/appliedList' },
                    { name: 'In-Progress Task', href: '/employee/currentList' },
                    { name: 'Profile', href: '/employee/profile' },
                    { name: 'Logout', href: '/employee/logout' },
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
                        {employee.map((employee: any, index: number) => (
                            <tr key={index}>
                                <th>{index + 2}</th>
                                <td>{employee.name}</td>
                                <td>{employee.email}</td>
                                <td>{employee.aboutEmployee}</td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employee/edit/${employee.id}`}>
                                        Edit
                                    </Link>
                                </td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employee/delete/${employee.id}`}>
                                        Delete
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