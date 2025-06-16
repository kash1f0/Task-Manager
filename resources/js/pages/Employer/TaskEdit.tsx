import { router } from '@inertiajs/react';
import Form from '../../CustomComponents/Form';
import Layout from '../../CustomComponents/Layout';
import Navbar from '../../CustomComponents/Navbar';
export default function TaskEdit({ children, task }) {
    const handleSubmit = (id) => {
        router.delete(`/task/delete/${id}`);
    };
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
            <Layout>
                <Form
                    method="post"
                    route={`/task/edit/submit/${task.id}`}
                    fields={[
                        { name: 'title', type: 'text', label: 'Title: ', placeholder: 'Enter the title' },
                        { name: 'description', type: 'text', label: 'Description: ', placeholder: 'Enter the description:' },
                        { name: 'due_date', type: 'date', label: 'Due Date: ', placeholder: 'Select the due date' },
                    ]}
                    buttonVal="Edit Task"
                />
            </Layout>
            <button
                className="btn btn-outline btn-error"
                onClick={() => {
                    handleSubmit(task.id);
                }}
            >
                Delete Task
            </button>
        </div>
    );
}
