import Form from '../../CustomComponents/Form';

export default function Create({}) {
    return (
        <div>
            <h1>Create Employee</h1>
            <p>This is the create employee page.</p>
            <Form
                method="post"
                route="/employer/create/submit"
                fields={[
                    { name: 'name', type: 'text', label: 'Name: ', placeholder: 'Enter your name' },
                    { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                    { name: 'photo', type: 'file', label: 'Photo: ' },
                    { name: 'password', type: 'password', label: 'Password: ', placeholder: 'Enter your password' },
                    { name: 'confirm_password', type: 'password', label: 'Confirm Password: ', placeholder: 'Confirm your password' },
                ]}
            />
        </div>
    );
}