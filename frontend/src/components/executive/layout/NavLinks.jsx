import {
  Calendar,
  Users,
  FileChartColumn,
  Building2,
  Settings,
  Bell,
  UserStar,
  ChartNoAxesColumn,
  CircleDollarSign,
} from "lucide-react";

export const navLinks = [
  {
    title: "MANAGEMENT",
    menuItems: [
      { icon: ChartNoAxesColumn, label: "Dashboard", to: "/executive" },
      { icon: CircleDollarSign, label: "Reports & Analytics", to: "reports-analytics" },
      { icon: UserStar, label: "Taxpayer", to: "taxpayers" },
      { icon: FileChartColumn, label: "Department Reports", to: "department-reports" },
      { icon: Settings, label: "Settings", to: "settings" },
    ],
  },
];

