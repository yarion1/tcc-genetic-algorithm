module.exports = function(grunt) {
  return {
    options: {
      files: ['composer.json', 'intl-tel-input.jquery.json', 'component.json', 'composer.json'],
      updateConfigs: ['package'],
      commitFiles: ['-a'],
      pushTo: 'origin'
    }
  };
};
