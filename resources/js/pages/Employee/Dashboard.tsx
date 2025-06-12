import Navbar from '../../CustomComponents/Navbar';

export default function Dashboard() {
    return (
        <>
            <Navbar
                fields={[
                    { name: 'Find Job', href: '/employee/findTasks' },
                    { name: 'Completed Jobs', href: '#' },
                    { name: 'Applied Jobs', href: '#' },
                    { name: 'In-Progress Jobs', href: '#' },
                ]}
                account={{ profile: '#', delete: '#' }}
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
