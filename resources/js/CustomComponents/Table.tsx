import {router} from '@inertiajs/react';
import React from 'react';

export default function Table({ tasks, headers }) {
    const handleClick = (taskId, taskLink) => {
        console.log(`Task ID: ${taskId}, Task Link: ${taskLink}`);
        router.post(taskLink, {
            task_id: taskId,});
    }
    return (
        <div className="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table className="table">
                <thead>
                    <tr>
                        <th></th>
                        {headers.map((header, index) => (
                            <th key={index}>{header}</th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    {tasks.map((task, index) => (
                        <tr key={index}>
                            <th>{index + 2}</th>
                            <td>{task.title}</td>
                            <td>{task.description}</td>
                            <td>{Date()}</td>
                            <td>
                                <button className="btn btn-outline btn-accent" onClick={()=> handleClick(task.id, task.href)}>Apply</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
