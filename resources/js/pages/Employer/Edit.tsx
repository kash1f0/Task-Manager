import { router } from '@inertiajs/react';
import Form from '../../CustomComponents/Form';
import Navbar from '../../CustomComponents/Navbar';
export default function Edit({ employer }) {
    const handleSubmit = (id) => {
        router.delete(`/employer/delete/${id}`);
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
            <Form
                method="post"
                route={`/employer/edit/submit`}
                fields={[
                    { name: 'name', type: 'text', label: 'Name: ', placeholder: 'Enter your name' },
                    { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                ]}
            />
            <button
                className="btn btn-outline btn-error"
                onClick={() => {
                    handleSubmit(employer.id);
                }}
            >
                Delete
            </button>
        </div>
    );
}