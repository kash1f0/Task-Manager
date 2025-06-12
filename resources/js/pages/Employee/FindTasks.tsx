import Navbar from '../../CustomComponents/Navbar';

export default function FindTasks({tasks}) {
    return (
        <>
            <Navbar
                fields={[
                    { name: 'Find Job', href: '/employee/findTasks'},
                    { name: 'Completed Jobs', href: '#' },
                    { name: 'Applied Jobs', href: '#' },
                    { name: 'In-Progress Jobs', href: '#' },
                ]}
                account={{ profile: '#', delete: '#' }}
            />
            <div>
                <h1>Find Jobs</h1>
                <ul>
                    {tasks.map((task, index) => (
                        <li key={index}>
                            <h2>{task.title}</h2>
                            <p>{task.description}</p>
                            <p>Due Date: {task.due_date}</p>
                        </li>
                    ))}
                </ul>
            </div>
        </>
    );
}
