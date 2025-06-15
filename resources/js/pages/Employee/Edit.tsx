import { router } from '@inertiajs/react';
import Form from '../../CustomComponents/Form';
import Navbar from '../../CustomComponents/Navbar';
export default function Edit({ employee }) {
    
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
            <Form
                method="post"
                route={`/employee/edit/submit`}
                fields={[
                    { name: 'name', type: 'text', label: 'Name: ', placeholder: 'Enter your name' },
                    { name: 'email', type: 'email', label: 'Email: ', placeholder: 'Enter your email' },
                    { name: 'photo', type: 'file', label: 'Photo: ' },
                    { name: 'aboutEmployee', type: 'textarea', label: 'About Employee: ', placeholder: 'Enter details about the employee' },
                ]}
            />
            
        </div>
    );
}