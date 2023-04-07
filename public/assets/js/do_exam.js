function countDown(minutes, seconds) {
    let totalSeconds = minutes * 60 + seconds;
    const intervalId = setInterval(() => {
      const minutesRemaining = Math.floor(totalSeconds / 60);
      const secondsRemaining = totalSeconds % 60;
      console.log(`${minutesRemaining} : ${secondsRemaining} `);
      totalSeconds--;
      if (totalSeconds < 0) {
        clearInterval(intervalId);
      }
    }, 1000); // 1000 milliseconds = 1 second
  }