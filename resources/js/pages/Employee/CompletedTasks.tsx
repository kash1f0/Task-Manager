import { Link } from '@inertiajs/react';
import Navbar from '../../CustomComponents/Navbar';

export default function CompletedTasks({ tasks }) {
    const headers = ['Title', 'Description', 'Due Date'];
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
                        {tasks.map((task: any, index: number) => (
                            <tr key={index}>
                                <th>{index + 2}</th>
                                <td>{task.title}</td>
                                <td>{task.description}</td>
                                <td>{task.due_date}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}