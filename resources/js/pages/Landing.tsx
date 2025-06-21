import { router } from '@inertiajs/react';
export default function Landing() {
    const handleClick = (uri) => {
        router.get(uri);
    };
    return (
        <>
            <div>
                <h1 className="bold m-2 p-2 text-center">As an Employer: </h1>
                <div className="flex flex-col items-center gap-2">
                    <button
                        className="btn m-2 btn-wide p-2"
                        onClick={() => {
                            handleClick('/employer/create');
                        }}
                    >
                        Sign Up
                    </button>
                    <button
                        className="btn m-2 btn-wide p-2"
                        onClick={() => {
                            handleClick('/employer/login');
                        }}
                    >
                        Log In
                    </button>
                </div>
            </div>
            <div>
                <h1 className="bold m-2 p-2 text-center">--------------------------------------OR---------------------------------------</h1>
            </div>
            <div>
                <h1 className="bold m-2 p-2 text-center">As an Employee: </h1>
                <div className="flex flex-col items-center gap-2">
                    <button
                        className="btn btn-wide m-2 p-2"
                        onClick={() => {
                            handleClick('/employee/create');
                        }}
                    >
                        Sign Up
                    </button>
                    <button
                        className="btn btn-wide m-2 p-2"
                        onClick={() => {
                            handleClick('/employee/login');
                        }}
                    >
                        Log In
                    </button>
                </div>
            </div>
        </>
    );
}
