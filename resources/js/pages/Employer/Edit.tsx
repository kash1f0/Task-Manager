import Form from '../../CustomComponents/Form';
import Layout from '../../CustomComponents/Layout';
import Navbar from '../../CustomComponents/Navbar';

export default function Edit({ employer }) {
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
            <Layout>
                <Form
                    method="post"
                    route={`/employer/edit/submit`}
                    fields={[
                        { name: 'name', type: 'text', label: 'Name: ', placeholder: 'Enter your name' },
                        { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                    ]}
                    buttonVal="Edit Employer"
                />
            </Layout>
        </div>
    );
}
