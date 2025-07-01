export default function Alert({ message}) {
    return (
        <div role="alert" className="alert-soft alert alert-success">
            <span>{message}</span>
        </div>
    );
}
