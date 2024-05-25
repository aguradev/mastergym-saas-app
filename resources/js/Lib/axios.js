import axiosHttp from "axios";

axiosHttp.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axiosHttp.defaults.headers.post["Content-Type"] = "application/json";

export default axiosHttp;
