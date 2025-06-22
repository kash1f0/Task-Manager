// DateFormatter.tsx
const formatter = new Intl.DateTimeFormat('en-US', {
  year: 'numeric',
  month: 'long',
  day: '2-digit',
  hour12: true,
});

export default function DateFormatter({ date }: { date: string | undefined }) {
  if (!date) {
    return <span>-</span>; // Handle undefined/null dates
  }

  const dateObj = new Date(date);
  
  if (isNaN(dateObj.getTime())) {
    return <span>Invalid date</span>;
  }

  return <span>{formatter.format(dateObj)}</span>;
}