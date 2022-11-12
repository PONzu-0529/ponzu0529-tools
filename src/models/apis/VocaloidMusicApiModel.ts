// Style
import { ResponseStyle } from '@/models/ResponseStyle'
import { VocaloidMusicStyle } from '@/models/VocaloidMusicModel'

// Model
import { ApiModel } from '@/models/apis/ApiModel'


export class VocaloidMusicApiModel extends ApiModel {
  public async getMusicList(): Promise<ResponseStyle<Array<VocaloidMusicStyle>>> {
    const callApiResult = await this.callApi({
      url: `${ApiModel.getHost()}/api/v1/vocaloid-music/get-music-list`,
      body: { accessToken: 'test_access_token' }
    })

    if (callApiResult.status !== 'success') {
      console.error(callApiResult.data)
      return {
        status: 'failuer',
        data: []
      }
    }

    if (!Array.isArray(callApiResult.data)) {
      return {
        status: 'failuer',
        data: []
      }
    } else {
      return {
        status: 'success',
        data: callApiResult.data
      }
    }
  }
}
