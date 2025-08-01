import { Link } from '@inertiajs/react';
import Navbar from '../../CustomComponents/Navbar';
import { router } from '@inertiajs/react';
export default function Profile({ employer }) {
    const handleSubmit = (id) => {
        router.delete(`/employer/delete/${id}`);
    };
    const headers = ['Name', 'Email', 'Edit', 'Delete'];
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
                        {employer.map((employer: any, index: number) => (
                            <tr key={index}>
                                <th>{index + 2}</th>
                                <td>{employer.name}</td>
                                <td>{employer.email}</td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employer/edit/${employer.id}`}>
                                        Edit
                                    </Link>
                                </td>
                                <button
                                    className="btn btn-outline btn-error"
                                    onClick={() => {
                                        handleSubmit(employer.id);
                                    }}
                                >
                                    Delete
                                </button>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
