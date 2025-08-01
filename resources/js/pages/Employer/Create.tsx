import Form from '../../CustomComponents/Form';
import Layout from '../../CustomComponents/Layout';

export default function Create({}) {
    return (
        <div>
            <h1 className="bold m-2 p-2 text-center">Create Employer: </h1>
            <Layout>
                <Form
                    method="post"
                    route="/employer/create/submit"
                    fields={[
                        { name: 'name', type: 'text', label: 'Name: ', placeholder: 'Enter your name' },
                        { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                        { name: 'photo', type: 'file', label: 'Photo: ' },
                        { name: 'password', type: 'password', label: 'Password: ', placeholder: 'Enter your password' },
                        { name: 'password_confirmation', type: 'password', label: 'Confirm Password: ', placeholder: 'Confirm your password' },
                    ]}
                    buttonVal="Create Employer"
                />
            </Layout>
        </div>
    );
}
