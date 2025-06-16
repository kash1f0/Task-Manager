import Navbar from '../../CustomComponents/Navbar';
import Table from '../../CustomComponents/Table';

export default function FindTasks({ tasks }) {
    return (
        <>
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
            <div>
                <Table
                    tasks={tasks}
                    headers={['Title', 'Description', 'Due Date', 'Apply']}
                />
            </div>
        </>
    );
}
