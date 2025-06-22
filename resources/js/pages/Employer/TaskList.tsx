// import {router} from '@inertiajs/react';
import { Link } from '@inertiajs/react';
import Navbar from '../../CustomComponents/Navbar';
import DateFormatter from '@/CustomComponents/DateFormatter';
interface Task {
    id: number;
    title: string;
    description: string;
    due_date: string;
    // Add other fields if necessary
}

interface TaskListProps {
    tasks: Task[];
}

export default function TaskList({ tasks }: TaskListProps) {
    const headers = ['Title', 'Description', 'Due Date', 'See', 'Edit'];
    return (
        <div>
            <Navbar
                fields={[
                    { name: 'Create Task', href: '/employer/task/create' },
                    { name: 'Completed Tasks', href: '/employer/completedTasks' },
                    { name: 'Posted Tasks', href: '/employer/task/list' },
                    { name: 'In-Progress Tasks', href: '/employer/currentTasks' },
                    { name: 'Profile', href: '/employer/profile' },
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
                        {tasks.map((task: any, index: number) => (
                            <tr key={index}>
                                <th>{index + 2}</th>
                                <td>{task.title}</td>
                                <td>{task.description}</td>
                                <td> <DateFormatter date={task.due_date} /> </td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employer/employeeList/${task.id}`}>
                                        See
                                    </Link>
                                </td>
                                <td>
                                    <Link className="btn btn-outline btn-accent" href={`/employer/task/edit/${task.id}`}>
                                        Edit
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
