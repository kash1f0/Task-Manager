import Form from '../../CustomComponents/Form';
import Navbar from '../../CustomComponents/Navbar';
export default function Task({ children }) {
    return (
        <div>
            <Navbar fields={[{name: 'Create Task', href: '/employer/task/create'}, {name: 'Completed Tasks', href: '#'}, {name: 'Posted Tasks', href: '/employer/task/list'}, {name: 'In-Progress Tasks', href: '#'}]}  account={{profile: '#', delete: '#'}}/>
            <Form
                method="post"
                route="/employer/task/submit"
                fields={[
                    { name: 'title', type: 'text', label: 'Title: ', placeholder: 'Enter the title' },
                    { name: 'description', type: 'text', label: 'Description: ', placeholder: 'Enter the description:' },
                    { name: 'due_date', type: 'date', label: 'Due Date: ', placeholder: 'Select the due date' },
                ]}
            />
        </div>
    );
}
