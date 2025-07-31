import {
  Calendar,
  Users,
  FileChartColumn,
  Building2,
  Settings,
  Bell,
  UserStar,
  ChartNoAxesColumn,
  CircleDollarSign
} from "lucide-react";

export const navLinks = [
  {
    title: "MANAGEMENT",
    menuItems: [
      { icon: ChartNoAxesColumn, label: "Revenue Overview", to: "/" },
      { icon: Building2, label: "Business Registry",to: "/business-registry" },
      { icon: Bell, label: "Notification Center",to: "/notification-center" },
      { icon: CircleDollarSign, label: "Payments", to: "/calender" },
      { icon: UserStar, label: "Tax Collectors", to: "/calender" },
      { icon: FileChartColumn, label: "Reports", to: "/calender" },
      { icon: Settings, label: "Settings", to: "/calender" },
    ],
  }
];
