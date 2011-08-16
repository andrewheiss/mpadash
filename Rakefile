desc "Deploy to live server"
task :deploy do
  rsync "nfsn:/home/public/mpadash/sites/default/themes/mpadash/"
end

def rsync(location)
  sh "rsync -rtvz --exclude-from '.rsync' --delete --stats --progress . #{location}"
end