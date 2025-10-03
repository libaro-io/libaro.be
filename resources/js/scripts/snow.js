const letItSnow = () => {
    if (typeof document === 'undefined') {
        return;
    }

    const snowContainer = document.createElement('div');
    snowContainer.id = 'snow-container';
    snowContainer.style.position = 'fixed';
    snowContainer.style.inset = '0';
    snowContainer.style.width = '100vw';
    snowContainer.style.height = '100vh';
    snowContainer.style.overflow = 'hidden';
    snowContainer.style.pointerEvents = 'none';

    let css = `
    .snowflake {
      position: absolute;
      width: 10px;
      height: 10px;
      background: white;
      border-radius: 50%;
      margin-top: -10px;
    }
  `;

    const random = (a, b) => Math.floor(Math.random() * (b - a + 1)) + a;

    const isSmallScreen = window.innerWidth < 640;
    const scaleFactor = isSmallScreen ? .75 : 1;
    const snowflakeCount = isSmallScreen ? 150 : 200;

    for (let i = 1; i < snowflakeCount; i++) {
        const rndX = (random(0, 1000000) * 0.0001),
            rndO = random(-100000, 100000) * 0.0001,
            rndT = (random(3, 8) * 10).toFixed(2),
            rndS = (random(0, 10000) * 0.0001 * scaleFactor).toFixed(2);

        const snowflake = document.createElement('i');
        snowflake.classList.add('snowflake');
        snowflake.style.opacity = (random(1, 10000) * 0.0001).toFixed(2);
        snowflake.style.transform = `translate(${rndX.toFixed(2)}vw, -10px) scale(${rndS})`;
        snowflake.style.animation = `fall-${i} ${random(10, 30)}s -${random(0, 30)}s linear infinite`;

        snowContainer.appendChild(snowflake);

        css += `
      @keyframes fall-${i} {
        ${rndT}% {
          transform: translate(${(rndX + rndO).toFixed(2)}vw, ${rndT}vh) scale(${rndS});
        }
        100% {
          transform: translate(${(rndX + (rndO / 2)).toFixed(2)}vw, 105vh) scale(${rndS});
        }
      }
    `;
    }

    const style = document.createElement('style');
    style.appendChild(document.createTextNode(css));

    document.body.appendChild(snowContainer);
    document.head.appendChild(style);
}

export default () => {
    const currentMonth = new Date().getMonth();
    const isDecemberOrJanuary = currentMonth === 11 || currentMonth === 0;

    if (!isDecemberOrJanuary) {
        return;
    }

    letItSnow();
}
