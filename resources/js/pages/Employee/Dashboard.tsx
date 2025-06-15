import Navbar from '../../CustomComponents/Navbar';

export default function Dashboard() {
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
                <h1>Employee Dashboard</h1>
                <p>This is the employee dashboard page.</p>
                <p>Welcome to your dashboard!</p>
                <p>Here you can manage your profile, view tasks, and more.</p>
            </div>
        </>
    );
}
