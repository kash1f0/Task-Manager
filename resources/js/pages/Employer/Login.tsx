import Form from '../../CustomComponents/Form';

export default function Login({}) {
    return (
        <div>
            <h1>Login Employer</h1>
            <Form
                method="post"
                route="/employer/login/submit"
                fields={[
                    { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                    { name: 'password', type: 'password', label: 'Password: ', placeholder: 'Enter your password' },
                ]}
            />
        </div>
    );
}