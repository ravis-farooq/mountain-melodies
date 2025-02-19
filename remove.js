const fs = require('fs');
const path = require('path');

const directoryPath = './assets/imgs/page/pages'; // Path to the images directory
const projectPath = '.'; // Path to the project directory

function getAllFiles(dirPath, arrayOfFiles) {
  const files = fs.readdirSync(dirPath);
  arrayOfFiles = arrayOfFiles || [];

  files.forEach(file => {
    if (fs.statSync(path.join(dirPath, file)).isDirectory()) {
      arrayOfFiles = getAllFiles(path.join(dirPath, file), arrayOfFiles);
    } else {
      arrayOfFiles.push(path.join(dirPath, file));
    }
  });

  return arrayOfFiles;
}

// Get a list of all image files
const imageFiles = getAllFiles(directoryPath).filter(file => /\.(jpg|jpeg|png|gif|svg)$/.test(file));

// Get a list of all project files that might reference images
const projectFiles = getAllFiles(projectPath).filter(file => /\.(html|css|js|jsx|ts|tsx)$/.test(file));

function isImageUsed(imagePath, projectFiles) {
  const imageName = path.basename(imagePath);
  for (const file of projectFiles) {
    const content = fs.readFileSync(file, 'utf8');
    if (content.includes(imageName)) {
      return true;
    }
  }
  return false;
}

imageFiles.forEach(image => {
  if (!isImageUsed(image, projectFiles)) {
    console.log(`Unused image: ${image}`);
    fs.unlinkSync(image); // Remove the unused image
    console.log(`Removed image: ${image}`);
  }
});
