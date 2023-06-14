import GUI from 'lil-gui';
import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

const gui = new GUI();
const settings = {
  clockShouldVibe: false,
};

gui.add(settings, 'clockShouldVibe').name('Disco Mode');

const wrapper = document.querySelector('.app');
const canvas = wrapper.querySelector('canvas');

// Setup scene
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera( 75, canvas.clientWidth / canvas.clientHeight, 0.1, 1000 );

const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
camera.position.z = 7;

const updateRenderSizes = () => {
  camera.aspect = wrapper.clientWidth / wrapper.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(wrapper.clientWidth, wrapper.clientHeight);
  renderer.render(scene, camera);
};

updateRenderSizes();

new ResizeObserver(updateRenderSizes).observe(wrapper);
// End setup scene

// Lights
const light = new THREE.AmbientLight( 0x404040 );
scene.add( light );

const spotLight = new THREE.SpotLight( 0xffffff, 15 );
spotLight.position.set( 25, 50, 25 );
spotLight.angle = Math.PI / 6;
spotLight.penumbra = 1;
spotLight.decay = 2;
spotLight.distance = 100;
scene.add( spotLight );

const directionalLightWest = new THREE.DirectionalLight( 0xf9c303, 0.4 );
directionalLightWest.position.x = -10;
directionalLightWest.position.z = 4;
directionalLightWest.position.y = 2;
scene.add( directionalLightWest);
// const directionalLightHelperWest = new THREE.DirectionalLightHelper( directionalLightWest, 5 );
// scene.add( directionalLightHelperWest);

const directionalLightEast = new THREE.DirectionalLight( 0xffffff, 0.2 );
directionalLightEast.position.x = 10;
directionalLightEast.position.z = 4;
scene.add(directionalLightEast);
// const directionalLightHelperEast = new THREE.DirectionalLightHelper( directionalLightEast, 5 );
// scene.add( directionalLightHelperEast );
// End lights

// Models
let clockAnimationMixer;
const clockData = {
  isAnimating: true,
  materials: {
    base: [],
    accent: [],
  },
};

gui.add(clockData, 'isAnimating').name('Animate');

const loader = new GLTFLoader();
loader.load(
  // resource URL
  '/storage/models/libaro-logo.glb',
  // called when the resource is loaded
  function ( gltf ) {
    console.log(gltf);

    clockAnimationMixer = new THREE.AnimationMixer( gltf.scene );

    gltf.animations
      .map(a => clockAnimationMixer.clipAction(a))
      .forEach(action => action.play());

    gltf.scene.traverse(child => {
      if (! (child instanceof THREE.Mesh)) {
        return;
      }

      const map = {
        'Material_base': clockData.materials.base,
        'Material_accent': clockData.materials.accent,
      };

      const destinationArray = map[child.material.name];

      if (! destinationArray) {
        return;
      }

      destinationArray.push(child.material);
    });

    scene.add( gltf.scene );
    gltf.scene.rotateX(Math.PI * .4);
    gltf.scene.rotateZ(Math.PI * .2);
  },

  // called while loading is progressing
  function ( xhr ) {
    console.log( ( xhr.loaded / xhr.total * 100 ) + '% loaded' );
  },

  // called when loading has errors
  function (e) {
    console.error(e);
  },
);

const changeClockBaseColor = (color) => {
  clockData.materials.base.forEach(material => material.color = color);
}

const changeClockAccentColor = (color) => {
  clockData.materials.accent.forEach(material => material.color = color);
};

const makeClockVibe = (elapsedTime) => {
  if (! settings.clockShouldVibe) {
    return;
  }

  const newColor = new THREE.Color().setFromVector3(
    new THREE.Vector3(
      Math.sin(elapsedTime) * .5 + .5,
      Math.sin(elapsedTime * .3) * .5 + .5,
      Math.sin(elapsedTime % 16541) * .4 + .4,
    ),
  );

  changeClockBaseColor(newColor);

  const newAccentColor = newColor.clone().multiplyScalar(.5);

  changeClockAccentColor(newAccentColor);
};

gui.addColor({string: '#ffffff'}, 'string' )
  .name('Clock base')
  .onChange((value) => changeClockBaseColor(new THREE.Color(value)));

gui.addColor({string: '#ffffff'}, 'string' )
  .name('Clock accent')
  .onChange((value) => changeClockAccentColor(new THREE.Color(value)));
// End clock

// Controls
new OrbitControls(camera, renderer.domElement);
// End controls

const clock = new THREE.Clock();

function animate() {
  const deltaTime = clock.getDelta();
  const elapsedTime = clock.getElapsedTime();

  makeClockVibe(elapsedTime);

  if (clockData.isAnimating && clockAnimationMixer) {
    clockAnimationMixer.update(deltaTime);
  }

  requestAnimationFrame( animate );
  renderer.render( scene, camera );
}

animate();
