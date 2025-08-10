import { PieChart, Pie, Cell, Legend, ResponsiveContainer } from "recharts";

const data = [
	{ name: "Cash", value: 40, color: "#34d399" },
	{ name: "Mobile Money", value: 35, color: "#60A5FA" },
	{ name: "Bank Transfer", value: 25, color: "#a78bfa" },
];

const renderLegend = () => (
	<div className="flex justify-center gap-6 mt-4">
		<div className="flex flex-col items-center">
			<span className="flex items-center gap-1 text-green-500 font-semibold"><span className="w-3 h-3 rounded-full bg-green-400 inline-block"></span>Cash</span>
			<span className="font-bold text-lg text-black mt-1">40%</span>
		</div>
		<div className="flex flex-col items-center">
			<span className="flex items-center gap-1 text-blue-500 font-semibold"><span className="w-3 h-3 rounded-full bg-blue-400 inline-block"></span>Mobile Money</span>
			<span className="font-bold text-lg text-black mt-1">35%</span>
		</div>
		<div className="flex flex-col items-center">
			<span className="flex items-center gap-1 text-purple-500 font-semibold"><span className="w-3 h-3 rounded-full bg-purple-400 inline-block"></span>Bank Transfer</span>
			<span className="font-bold text-lg text-black mt-1">25%</span>
		</div>
	</div>
);

export default function PaymentCollectionsMethods() {
	return (
		<div className="bg-white rounded-lg shadow p-6">
			<h2 className="text-lg font-semibold mb-2">Collection by Method</h2>
			<ResponsiveContainer width="100%" height={300}>
				<PieChart>
					<Pie
						data={data}
						cx="50%"
						cy="50%"
						innerRadius={70}
						outerRadius={110}
						paddingAngle={2}
						dataKey="value"
						nameKey="name"
						label={false}
					>
						{data.map((entry, index) => (
							<Cell key={`cell-${index}`} fill={entry.color} />
						))}
					</Pie>
					<Legend
						verticalAlign="top"
						align="center"
						iconType="plainline"
						formatter={(value) => {
							if (value === "Cash") return <span className="text-green-500 font-semibold">Cash</span>;
							if (value === "Mobile Money") return <span className="text-blue-500 font-semibold">Mobile Money</span>;
							if (value === "Bank Transfer") return <span className="text-purple-500 font-semibold">Bank Transfer</span>;
							return value;
						}}
					/>
				</PieChart>
			</ResponsiveContainer>
			{renderLegend()}
		</div>
	);
}
