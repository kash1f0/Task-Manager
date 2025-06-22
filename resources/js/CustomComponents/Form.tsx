import { useForm } from '@inertiajs/react';

export default function Form({ method, route, fields, buttonVal }) {
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
        if (e.target.type === 'file') {
            setData((prev) => ({
                ...prev,
                [e.target.id]: e.target.files[0],
            }));
            return;
        }
        setData((prev) => ({
            ...prev,
            [e.target.id]: e.target.value,
        }));
    }

    return (
        <form className="m-4 fieldset w-xl rounded-box border border-base-300 bg-base-200 p-4" onSubmit={handleSubmit}>
            <legend className="fieldset-legend text-xl">{buttonVal}</legend>

            {fields.map((field) =>
                field.type === 'file' ? (
                    <div key={field.name}>
                        <div className="m-2 p-2 ml-0 pl-0">
                            <label className="label text-lg">{field.label}</label>
                        </div>
                        <input type={field.type} className="input" name={field.name} onChange={handleChange} id={field.name} />
                        {errors[field.name] && <span className="text-error">{errors[field.name]}</span>}
                    </div>
                ) : (
                    <div key={field.name}>
                        <div className="m-2 p-2 ml-0 pl-0">
                            <label className="label text-lg">{field.label}</label>
                        </div>
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

            <button className="btn mt-4 btn-neutral" type="submit">
                {buttonVal}
            </button>
        </form>
    );
}
