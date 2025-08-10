import { FaMoneyBillWave, FaRegFileAlt, FaBullseye, FaGift } from "react-icons/fa";
import { MdOutlineMobileFriendly } from "react-icons/md";
import { GiReceiveMoney } from "react-icons/gi";
import { BsBarChartFill } from "react-icons/bs";

export default function ReportsMetricsCards() {
	return (
		<div className="grid grid-cols-1 md:grid-cols-4 gap-3">
			{/* Total Revenue */}
			<div className="bg-white rounded-lg shadow p-4 flex items-center gap-4 min-w-[250px]">
				<div className="bg-blue-100 rounded-full p-3 flex items-center justify-center">
					<FaMoneyBillWave className="text-lg text-yellow-600" />
				</div>
				<div>
					<div className="text-gray-500 text-sm">Total Revenue (2023)</div>
					<div className="font-bold text-2xl">GHS 1,200,000</div>
					<div className="flex items-center gap-1 text-xs text-blue-600 mt-1">
						<BsBarChartFill />
						15% from last year
					</div>
				</div>
			</div>

			{/* Total Transactions */}
			<div className="bg-white rounded-lg shadow p-4 flex items-center gap-4 min-w-[250px]">
				<div className="bg-purple-100 rounded-full p-3 flex items-center justify-center">
					<FaRegFileAlt className="text-lg text-purple-400" />
				</div>
				<div>
					<div className="text-gray-500 text-sm">Total Transactions</div>
					<div className="font-bold text-2xl">8,540</div>
					<div className="text-xs text-gray-400 mt-1">For the current year</div>
				</div>
			</div>

			{/* Collection Target */}
			<div className="bg-white rounded-lg shadow p-4 flex items-center gap-4 min-w-[250px]">
				<div className="bg-green-100 rounded-full p-3 flex items-center justify-center">
					<FaBullseye className="text-lg text-green-400" />
				</div>
				<div className="flex-1">
					<div className="text-gray-500 text-sm">Collection Target</div>
					<div className="font-bold text-2xl">78% <span className="text-base font-normal text-gray-500">of GHS 1,500,000</span></div>
					<div className="w-full h-2 bg-gray-200 rounded mt-2">
						<div className="h-2 bg-green-500 rounded" style={{ width: "78%" }}></div>
					</div>
				</div>
			</div>

			{/* Most Common */}
			<div className="bg-white rounded-lg shadow p-4 flex items-center gap-4 min-w-[250px]">
				<div className="bg-yellow-100 rounded-full p-3 flex items-center justify-center">
					<FaGift className="text-lg text-yellow-400" />
				</div>
				<div>
					<div className="text-gray-500 text-sm">Most Common</div>
					<div className="flex items-center gap-2 mt-1">
						<GiReceiveMoney className="text-yellow-700" />
						<span className="font-semibold">Property Tax</span>
					</div>
					<div className="flex items-center gap-2 mt-1">
						<MdOutlineMobileFriendly className="text-blue-600" />
						<span className="font-semibold">Mobile Money</span>
					</div>
				</div>
			</div>
		</div>
	);
}
