async function getSessionData() {
    try {
        let response = await fetch("getSession.php");
        let data = await response.json();

        if (data.error) {
            console.log("Session expired or not logged in.");
            return null;
        }

        return data;
    } catch (error) {
        console.error("Error fetching session data:", error);
        return null;
    }
}