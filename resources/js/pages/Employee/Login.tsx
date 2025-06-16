import Form from '../../CustomComponents/Form';
import Layout from '../../CustomComponents/Layout';
export default function Login({}) {
    return (
        <div>
            <h1 className="text-center">Login Employee</h1>
            <Layout>
                <Form
                    method="post"
                    route="/employee/login/submit"
                    fields={[
                        { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                        { name: 'password', type: 'password', label: 'Password: ', placeholder: 'Enter your password' },
                    ]}
                    buttonVal="Login"
                />
            </Layout>
        </div>
    );
}
