module.exports = (grunt) ->

  grunt.initConfig

    # Copy Font Awesome files to /fonts directory
    copy:
      enquire:
        files: [
          expand: true
          cwd: 'bower_components/enquire/dist'
          src: ['enquire.min.js']
          dest: 'libs/enquire'
        ]
      superfish:
        files: [
          expand: true
          cwd: 'bower_components/superfish/dist/js'
          src: ['superfish.min.js']
          dest: 'libs/superfish'
        ]
      lightSlider:
        files: [
          expand: true
          cwd: 'bower_components/lightslider/lightSlider'
          src: ['**/*']
          dest: 'libs/lightSlider'
        ]

  # Build theme
  grunt.registerTask 'build', [
    'copy'
  ]

  # Load grunt modules
  grunt.loadNpmTasks('grunt-contrib-concat')
  grunt.loadNpmTasks('grunt-contrib-copy')
  grunt.loadNpmTasks('grunt-contrib-uglify')
