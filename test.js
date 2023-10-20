const axios = require("axios");
/// create a loop that queries localhost:8081 10 times
const headers = {
  authorization:
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiIxOTIuMTY4LjEyMy4xMDUiLCJzdWIiOiIxNSIsImV4cCI6MTY2NjEzMDQxNCwibmJmIjoiMjIyMi0xMC0xMSAxOToxMDoxNCIsImlhdCI6IjIyMjItMTAtMTEgMTk6MTA6MTQiLCJqdGkiOiJlODU0ZTU4MGU5NDQifQ.7snuq7JQP9ZNPN9CJiuQGv7VI1T7YIBuTWs3ikkyvZA",
};
async function loop() {
  let i = 0;
  while (true) {
    console.log(i);
    i++;
    await Promise.all([
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
      axios.get("http://localhost:8081/ws/v2/diet/meal", { headers }),
    ]);
  }
}

loop();
