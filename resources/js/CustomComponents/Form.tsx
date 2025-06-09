import { router, useForm } from '@inertiajs/react';

export default function Form({ method, route, fields }) {
    const { data, setData, errors, post, get } = useForm(
        fields.reduce(
            (acc, field) => ({
                ...acc,
                [field.name]: field.type === 'file' ? null : '',
            }),
            {},
        ),
    );

    function handleSubmit(e) {
        e.preventDefault();
        if (method === 'post') {
            post(route, data);
        } else {
            get(route);
        }
    }

    function handleChange(e) {
        // If the field is a file, we need to handle it differently
        if (e.target.type === 'file') {
            setData((prev) => ({
                ...prev,
                [e.target.id]: e.target.files[0], // Store the file object )
            }));
            return;
        }
        setData((prev) => ({
            ...prev,
            [e.target.id]: e.target.value, // Store the file object )
        }));
    }

    return (
        <form className="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4" onSubmit={handleSubmit}>
            <legend className="fieldset-legend">Login</legend>

            {fields.map((field) =>
                field.type === 'file' ? (
                    <div key={field.name}>
                        <label className="label">{field.label}</label>
                        <input type={field.type} className="input" name={field.name} onChange={handleChange} id={field.name} />
                        {errors[field.name] && <span className="text-error">{errors[field.name]}</span>}
                    </div>
                ) : (
                    <div key={field.name}>
                        <label className="label">{field.label}</label>
                        <input
                            type={field.type}
                            name={field.name}
                            className="input"
                            placeholder={field.placeholder}
                            id={field.name}
                            onChange={handleChange}
                        />
                        {errors[field.name] && <span className="text-error">{errors[field.name]}</span>}
                    </div>
                ),
            )}

            <button className="btn btn-neutral mt-4" type="submit">
                Login
            </button>
        </form>
    );
}
