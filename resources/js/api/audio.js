import request from '@/utils/request';

export function insertData(data) {
  return request({
    url: '/admin/audio/store',
    method: 'post',
    data,
  });
}
export function getAudioInfo(id) {
  return request({
    url: '/admin/audio/' + id,
    method: 'get',
  });
}
export function fetchList(query) {
  return request({
    url: '/admin/audio',
    method: 'get',
    params: query,
  });
}

export function fetchArticle(id) {
  return request({
    url: '/articles/' + id,
    method: 'get',
  });
}

export function fetchPv(id) {
  return request({
    url: '/articles/' + id + '/pageviews',
    method: 'get',
  });
}

export function createArticle(data) {
  return request({
    url: '/article/create',
    method: 'post',
    data,
  });
}

export function updateArticle(data) {
  return request({
    url: '/article/update',
    method: 'post',
    data,
  });
}
