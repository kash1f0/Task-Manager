export default function Navbar({fields}) {
    return (
        <div className="navbar bg-base-100 shadow-sm">
            <div className="navbar-start">
                <div className="dropdown">
                    <div tabIndex={0} role="button" className="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            {' '}
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h8m-8 6h16" />{' '}
                        </svg>
                    </div>
                    <ul tabIndex={0} className="dropdown-content menu z-1 mt-3 w-52 menu-sm rounded-box bg-base-100 p-2 shadow">
                        <li>
                            <a>Item 1</a>
                        </li>
                        <li>
                            <a>Item 3</a>
                        </li>
                    </ul>
                </div>
                <a className="btn text-xl btn-ghost">Task Manager</a>
            </div>
            <div className="navbar-center lg:flex">
                <ul className="menu menu-horizontal px-1">
                    {
                        fields.map((field, index) => (
                            <li key={index}>
                                <a href={field.href}>{field.name}</a>
                            </li>
                        ))
                    }
                </ul>
            </div>
        </div>
    );
}
